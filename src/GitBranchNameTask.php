<?php

/**
 * Contains TomEganTech\GetGitBranchNameTask
 *
 * @author    Tom Egan <tom@tomegan.tech>
 * @copyright Copyright (c) 2023 Tom Egan
 * @license   http://opensource.org/licenses/MIT MIT License
 */

namespace TomEganTech\GitMetaDataPhingTasks;

use Phing\Exception\BuildException;

/**
 * Define a property containing the name of your project's current git branch name
 */
class GitBranchNameTask extends AbstractGitMetaDataTask
{
    /**
     * The entry point for the task; called when task is invoked
     *
     * @return void
     */
    public function main()
    {
        if ($this->property === null) {
            throw new BuildException(
                'You must specify the property attribute',
                $this->getLocation()
            );
        }

        $this->project->setProperty(
            $this->property,
            $this->getBranchName()
        );
    }
}
