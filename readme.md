# Evans

### Develop

```
$ yarn serve
$ yarn start
```

### Migrations

```
$ yarn reset // rollback all, migrate & seed
$ phinx migrate
$ phinx rollback // rollback one migration
$ phinx rollback -t 0 // rollback all migrations
$ phinx create MyNewMigration
$ phinx seed:create FriendSeeder
$ phinx seed:run
$ phinx seed:run -s FriendSeeder
```
