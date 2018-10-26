# Blog
## Todo
- [X] Basic Database Migrations
- [X] Basic Users APIs
    - [X] Login
    - [X] Logout
    - [X] Show profile
- [X] Basic Posts APIs
    - [X] List
    - [X] Create
    - [X] Update
    - [X] Read
    - [X] Delete
- [ ] Comment system
- [ ] Authentication control
- [ ] Open user system

## Devs
### Object Definition
```js
Post({
    hash: "string",
    shortname: "string",
    topic: "string",
    summary: "string",
    body: "string",
    created_by: "integer",
    [author]: {
        hash: "string",
        name: "string"
    }
    created_at: "datetime",
    updated_at: "datetime"
});

User({
    hash: "string",
    name: "string",
    updated_at: "datetime"
});
```

### APIs
* `POST /login`
* `GET /logout`
* `GET /profile`
* `GET /posts`
* `POST /posts`
* `PATCH /posts/{shortname}`
* `GET /posts/{shortname}`
    * `GET /posts[?hash=xxx|shortname=xxx][?skip=0][?take=10]`
* `DELETE /posts/{shortname}`
