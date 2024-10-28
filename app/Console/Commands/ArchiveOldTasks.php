<?php

namespace App\Console\Commands;

use App\Models\Status;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ArchiveOldTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:archive-old-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Arquiva tarefas concluídas há mais de 30 dias';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $archivedStatusId = Status::where('name', 'archived')->value('id');

        if (!$archivedStatusId) {
            $this->error('Status "archived" não encontrado na tabela de status.');
            return;
        }

        $tasks = Task::where('status_id', Status::where('name', 'completed')->value('id'))
            ->where('updated_at', '<', Carbon::now()->subDays(30))
            ->get();

        foreach ($tasks as $task) {
            $task->status_id = $archivedStatusId;
            $task->save();
        }

        $this->info('Tarefas concluídas há mais de 30 dias foram arquivadas com sucesso.');
    }
}
