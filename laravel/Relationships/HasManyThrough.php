<?php
/*
 * projects - id, name
 * environments - id, project_id, name
 * deployments - id, environment_id, commit_hash
 * Можно получить множество развертываний проекта через модель среды (окружения)
 */

class Project extends Model
{
    public function deployments(): HasManyThrough
    {
        return $this->hasManyThrough(Deployment::class, Environment::class);
        //return $this->hasManyThrough(Deployment::class, Environment::class, 'project_id', 'environment_id', 'id', 'id');
        //return $this->through('environments')->has('deployments'); // если связи определены в моделях
    }
}