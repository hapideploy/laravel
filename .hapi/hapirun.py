from hapi.toolbox import app

from hapi.recipe.laravel import Laravel

app.load(Laravel)

app.put('name', 'Laravel')
app.put('repository', 'https://github.com/hapideploy/laravel')
app.put('branch', 'main')

app.add('shared_dirs', [])
app.add('shared_files', [])
app.add('writable_dirs', [])

if __name__ == '__main__':
    app.start()
