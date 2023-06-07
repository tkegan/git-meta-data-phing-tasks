# Git Meta Data Phing Tasks

A small collection of [Phing](https://www.phing.info/) tasks for obtaining meta
data for a git repo as properties in your build file.

## Installation

These tasks can be installed with Composer.

```sh
composer require "tomegantech/git-meta-data-phing-tasks"
```

## Usage

The tasks can the be used in your `build.xml`:

```xml
<taskdef name="git-branch-name" classname="TomEganTech\GitMetaDataPhingTasks\GitBranchNameTask" />
<git-branch-name property="build.branchName" />
```

```xml
<taskdef name="git-commit-id" classname="TomEganTech\GitMetaDataPhingTasks\GitCommitIdTask" />
<git-commit-id property="build.commitId" />
```

## Dependencies

- Phing 3.0+

**Note** you do not need a git executable as this library reads the git metadata
from the filesystem. Though typically a risky design choice as changes to git
internals would break these tasks, the files involved have not changed for
multiple major versions and not having a functioning git executable was a design
constraint of the work which prompted the creation of this library.
