from hapi.cli import app

from hapi.recipe.laravel import Laravel

app.load(Laravel)

app.put('name', 'laravel')
app.put('repository', 'https://github.com/hapideploy/laravel')
app.put('branch', 'main')

app.add('shared_dirs', [])
app.add('shared_files', [])
app.add('writable_dirs', [])
