# Get Git Branch Name Phing Task

A task for placing your project's current branch name in a property

## Installation

This task can be installed with Composer.

```sh
composer require "tomegantech/get-git-branch-name-phing-task"
```

The task can the be used in your build.xml:

```xml
<taskdef name="GetGitBranchName" classname="tomegantech/get-git-branch-name-phing-task" />
<GetGitBranchName property="build.branchName" />
```
