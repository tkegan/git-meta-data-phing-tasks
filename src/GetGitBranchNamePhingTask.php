<?php

/**
 * Contains TomEganTech\GetGitBranchNamePhingTask
 *
 * @author    Tom Egan <tom@tomegan.tech>
 * @copyright Copyright (c) 2023 Tom Egan
 * @license   http://opensource.org/licenses/MIT MIT License
 */

namespace TomEganTech;

use Phing\Task;

/**
 * Define a property containing the name of your project's current git branch name
 */
class GetGitBranchNamePhingTask extends Task
{
    /**
     * The name of the property the branch name will be written into.
     */
    protected string $property;

    /**
     * Set the name of the property the branch name will be written into.
     *
     * @param string $property  the name of the property the branch name will be
     *      written into.
     * @return void
     */
    public function setProperty($property)
    {
        $this->property = (string) $property;
    }

    /**
     * Get the name of the property the branch name will be written into.
     *
     * @return string  the name of the property the branch name will be written
     *      into.
     */
    public function getProperty()
    {
        return $this->property;
    }

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

        $file = new PhingFile('.git/HEAD');
        if (!$file->exists()) {
            throw new BuildException(
                'Build does not appear to be in a git repository',
                $this->getLocation()
            );
        }


        $reader = new FileReader($file);
        $buffer = $reader->read();
        $reader->close();

        if (!str_starts_with($buffer, 'ref: refs/heads/')) {
            throw new BuildException(
                'Current Branch is anomalous, are you in the middle of a merge?',
                $this->getLocation()
            );
        }

        $this->project->setProperty($name, substr($buffer, 16));
    }
}
