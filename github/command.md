Git force pull to overwrite local files
```
git fetch --all
git reset --hard origin/master
git pull origin master
```
Clear all local commit
```
git reset --soft HEAD~1
git pull
```
Create and checkout new branch
```
git checkout -b <new-branch>
```
Create branch from other branch
```
git fetch --all
git checkout -b ＜new-branch＞ ＜old-branch＞
```
Delete branch
```
git branch -D <branch> #force delete, soft delete sử dụng -d
git push origin :old_branch #xóa trên cloud
```
Rename branch
```
git branch -m old_branch new_branch         # Rename branch locally    
git push origin :old_branch                 # Delete the old branch    
git push --set-upstream origin new_branch   # Push the new branch, set local branch to track the new remote
```
Checkout other branch but keep changed file
```
git stash push
git checkout <other branch>
git stash apply
```
Merger from other branch
```
git fetch && git rebase origin/branch_name
git merge branch_need_merge_to_current_branch #option 2
```
Cancel rebase
```
git rebase --abort
```
revert commit
```
git log => copy hash of latest commit and commit before commit you want revert
git reset --hard commit_you_want_revert
git reset --soft commiit_latest
```
Process conflic
```
git log => copy hash of commit before the conflic happen
git reset --soft commit_hash_before_conflic
#copy all file change to other folder
git fetch
git rebase origin/latest_branch_name
#copy all change files from folder above to git
#using editor to revert change not is your change
git commit
git push -f
```
Add ssh key
```
eval "$(ssh-agent -s)"
ssh-add ~/your_key_path
```
Action with ssh key
```
git -c core.sshCommand='ssh -i <your git key path>' <git command>
```

# git secret
install 
```
aws: git clone https://github.com/awslabs/git-secrets.git
aws, azue, GCP: git clone https://github.com/msalemcode/git-secrets.git
After clone: ./install.ps1
```
Implement for project
```
cd my-repo
git secrets install
Provider AWS: git secrets --register-aws
Provider Azure: git secrets --register-azure
Provider GCP: git secrets --register-gcp
Custom pattern: git secrets --add-provider --cat /path/to/secret/file/patterns
```
