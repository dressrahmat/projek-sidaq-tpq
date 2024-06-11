<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public string $tableName = 'users';

    public array $contact = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setPerPageAccepted([5, 10, 25]);
    }

    #[On('refresh-data')]
    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hideIf(request()->routeIs('users.index')),
            Column::make('Name', 'name')
                ->searchable()->sortable(),
            Column::make('Email', 'email')
                ->searchable()->sortable(),
            Column::make('Roles', 'id')
                ->format(fn ($value) => implode(', ', DB::table('model_has_roles')
                    ->where('model_type', 'App\Models\User')
                    ->where('model_id', $value)->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->get()
                    ->pluck('name')->toArray()))
                ->searchable()->sortable(),
            Column::make('Aksi')->label(fn ($row, Column $column) => view('components.partials.datatable.aksi')->withRow($row)),
        ];
    }

    public function builder(): Builder
    {
        return User::query();
    }
}