<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Model;

class DataTableHandler
{
    protected $model;
    protected $relations = [];
    protected $columns = [];
    protected $rawColumns = [];
    protected $conditions = [];
    protected $gates = [];
    protected $crudRoutePart;

    public function __construct(Model $model, array $config = [])
    {
        $this->model = $model;
        $this->relations = $config['relations'] ?? [];
        $this->conditions = $config['conditions'] ?? [];
        $this->columns = $config['columns'] ?? []; 
        $this->gates = $config['gates'] ?? [];
        $this->rawColumns = $config['rawColumns'] ?? [];
        $this->crudRoutePart = $config['crudRoutePart'] ?? strtolower(class_basename($model));
    }

    protected function getColumnRenderer($type, $column, $options = [])
    {
        return match($type) {
            'checkbox' => function ($row) use ($column, $options) {
                $modelClass = $options['model'] ?? get_class($this->model);
                
                // Handle nested relation properties like 'user.block'
                $value = $column;
                $checked = '';
                $id = $row->id;
                if (str_contains($column, '.')) {
                    $parts = explode('.', $column);
                    $relation = $parts[0];
                    $field = $parts[1];
                    if ($row->{$relation}) {
                        $checked = $row->{$relation}->{$field} ? 'checked' : '';
                        $value = $field;
                        $id = $row->{$relation}->id;
                    }
                } else {
                    $checked = $row->{$column} ? 'checked' : '';
                }

                $disabled = isset($options['disabled']) && $options['disabled'] === true ? 'disabled' : '';
                
                return '<div class="custom-toggle-switch toggle-md ms-2">
                    <input onchange="updateStatuses(this, \'' . $value . '\', \'' . addslashes($modelClass) . '\')" 
                        value="' . $id . '" 
                        id="' . $column . $id . '"
                        type="checkbox"
                        ' . $disabled . ' 
                        ' . $checked . '>
                    <label for="' . $column . $id . '" class="label-success mb-2"></label>
                </div>';
            },
            'image' => function ($row) use ($column, $options) {
                if ($photo = $row->{$column}) {
                    $width = $options['width'] ?? '50px';
                    $height = $options['height'] ?? '50px';
                    return sprintf(
                        '<a href="%s" target="_blank"><img style="border-radius: 8px;" src="%s" width="%s" height="%s"></a>',
                        $photo->url,
                        $photo->thumbnail,
                        $width,
                        $height
                    );
                }
                return '';
            },
            'relation-many' => function ($row) use ($column, $options) {
                $labels = [];
                foreach ($row->{$column} as $item) {
                    $labels[] = sprintf('<span class="badge bg-info-transparent">%s</span>', $item->{$options['column']});
                }

                return implode(' ', $labels);
            },
            default => null
        };
    }

    public function handle(Request $request)
    {
        if (!$request->ajax()) {
            return null;
        }

        $query = $this->model->with($this->relations);
        
        if (isset($this->conditions)) {
            foreach ($this->conditions as $condition) {
                $query->where($condition['column'], $condition['operator'], $condition['value']);
            }
        }
        
        $query->select(sprintf('%s.*', $this->model->getTable()));
        $table = Datatables::of($query);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $viewGate = $this->gates['view'] ?? strtolower(class_basename($this->model)) . '_show';
            $editGate = $this->gates['edit'] ?? strtolower(class_basename($this->model)) . '_edit';
            $deleteGate = $this->gates['delete'] ?? strtolower(class_basename($this->model)) . '_delete';
            $crudRoutePart = $this->crudRoutePart;

            return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
        });

        foreach ($this->columns as $column => $config) {
            if (is_array($config) && isset($config['type'])) {
                $renderer = $this->getColumnRenderer($config['type'], $column, $config['options'] ?? []);
                if ($renderer) {
                    $table->editColumn($column, $renderer);
                    if (in_array($config['type'], ['checkbox', 'image', 'relation-many'])) {
                        $this->rawColumns[] = $column;
                    }
                }
            } else {
                $table->editColumn($column, $config); 
            }
        }

        $table->rawColumns(array_merge(['actions', 'placeholder'], $this->rawColumns));

        return $table->make(true);
    } 
} 