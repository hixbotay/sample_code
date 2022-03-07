# Use case: Group your commits, Delete some commits or fix a wrong commit
1. Run below command to show all commit id
```
git log
```
2. Copy a commit id before your commit to fix
3. Run command to reset to before you commit (by this way, your all change files still keep content after the commit)
```
git reset --soft <commit_id>
```
4. Do your fixing
5. Commit
```
git commit "your message"
```
7. Force push
```
git push -f
```
