<?php

/**
 * Contains TomEganTech\GitMetaDataPhingTasks\AbstractGitMetaDataTask
 *
 * @author    Tom Egan <tom@tomegan.tech>
 * @copyright Copyright (c) 2023 Tom Egan
 * @license   http://opensource.org/licenses/MIT MIT License
 */

namespace TomEganTech\GitMetaDataPhingTasks;

use Phing\Exceptions\BuildException;
use Phing\Io\File;
use Phing\Io\FileReader;
use Phing\Task;

/**
 * Define a property storing some meta data about a git repository
 */
class AbstractGitMetaDataTask extends Task
{
    /** The name of the property */
    protected string $property;

    /**
     * Set the name of the property
     *
     * @param string $property  the name of the property
     * @return void
     */
    public function setProperty(string $property)
    {
        $this->property = (string) $property;
    }

    /**
     * Get the name of the current branch in the git repo
     *
     * @return string  the name of the current branch in the git repo
     */
    protected function getBranchName(): string
    {
        $file = new File('.git/HEAD');
        if (!$file->exists()) {
            throw new BuildException(
                'Build does not appear to be in a git repository',
                $this->getLocation()
            );
        }

        $reader = new FileReader($file);
        $buffer = trim($reader->read());
        $reader->close();

        if (!str_starts_with($buffer, 'ref: refs/heads/')) {
            throw new BuildException(
                'Git internals appear to be corrupted',
                $this->getLocation()
            );
        }

        // trim off 'ref: refs/heads/' to get the current branch name
        return substr($buffer, 16);
    }
}
