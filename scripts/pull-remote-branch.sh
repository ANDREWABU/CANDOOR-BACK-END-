#!/bin/bash

#test
pwd
cd /var/www/html/candoor-backend
pwd
git branch
git status

current_branch=$(git symbolic-ref --short HEAD)

# Check the branch name
if [ "$current_branch" == "development" ]; then
    # Switch to the 'development' branch
    git switch development
    # Pull changes from the remote 'development' branch
    git reset --hard HEAD
    git pull
else
    echo "Not on the 'development' branch. No action taken."
fi

git status
git reset --hard HEAD
git pull

