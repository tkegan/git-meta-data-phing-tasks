<?php

/**
 * Contains TomEganTech\GitCommitIdTask
 *
 * @author    Tom Egan <tom@tomegan.tech>
 * @copyright Copyright (c) 2023 Tom Egan
 * @license   http://opensource.org/licenses/MIT MIT License
 */

namespace TomEganTech\GitMetaDataPhingTasks;

use Phing\Exception\BuildException;
use Phing\Io\File;
use Phing\Io\FileReader;

/**
 * Define a property containing the name of your project's current git branch name
 */
class GitCommitIdTask extends AbstractGitMetaDataTask
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

        $file = new File('.git/refs/heads/' . $this->getBranchName());
        if (!$file->exists()) {
            throw new BuildException(
                'No commit id available for HEAD. Have you committed to the current branch yet?',
                $this->getLocation()
            );
        }

        $reader = new FileReader($file);
        $buffer = trim($reader->read());
        $reader->close();

        $this->project->setProperty(
            $this->property,
            $buffer
        );
    }
}
