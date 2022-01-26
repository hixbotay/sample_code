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