# Notes

## Startup
```shell
docker compose up -d
```

## Export/Import Database
### Export NotesDB from Container
```shell
docker exec notes_db /usr/bin/mysqldump -uroot -pNotesPW NotesDB > database/NotesDB_backup.sql
```

### Import Notes.sql to Container
```shell
docker exec -i notes_db mysql -uroot -pNotesPW NotesDB < database/NotesDB_backup.sql
```