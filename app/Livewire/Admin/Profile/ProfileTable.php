<?php

namespace App\Livewire\Admin\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProfileTable extends DataTableComponent
{
    public string $tableName = 'profile';

    public array $profile = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setPerPageAccepted([5, 10, 25]);
        $this->setColumnSelectDisabled();
    }

    public function filters(): array
    {
        $roles = Role::all()->pluck('name', 'id')->toArray();
        $roles[''] = 'Semua Jabatan'; // Add an option for 'Semua Jabatan'

        return [
            SelectFilter::make('Jabatan')
                ->options($roles)
                ->filter(function (Builder $query, $value) {
                    if ($value) {
                        $query->whereHas('user', function ($q) use ($value) {
                            $q->whereHas('roles', function ($q) use ($value) {
                                $q->where('id', $value);
                            });
                        });
                    }
                }),

                SelectFilter::make('Murobbi')
                ->options([
                    '' => 'All',
                    '1' => 'Sudah ada murobbi',
                    '0' => 'Belum ada murobbi',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->wherenotNull('profile.id_murobbi');
                    } elseif ($value === '0') {
                        $builder->whereNull('profile.id_murobbi');
                    }
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(auth()->user()->id),
            Column::make("Nama lengkap", "nama_lengkap")
                ->sortable(),
            Column::make("Ustadz", "murobbi.profile.nama_lengkap")
                ->format(
                    fn($value, $row, Column $column) => $value ? $value : 'belum ada murobbi'
                ),
            Column::make("Email", "user.email")
            ->sortable(),
            Column::make("Jabatan", "user.roles.id")
                ->format(fn ($value) => implode(", ", DB::table('model_has_roles')
                ->where('model_type', 'App\Models\User')
                ->where('model_id', $value)->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->get()
                ->pluck('name')->toArray())
            ) 
                ->searchable()
                ->sortable(),
            Column::make('Aksi')->label(fn ($row, Column $column) => view('components.partials.datatable.aksi')->withRow($row)),
        ];
    }

    public function builder(): Builder
    {
        return Profile::with(['user.roles', 'murobbi'])->whereHas('user', function($q){
            $q->where('id_masjid', auth()->user()->id_masjid);
        });
    }
}