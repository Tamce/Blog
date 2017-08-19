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
    uri: "string",
    topic: "string",
    summary: "string",
    body: "string",
    createdBy: "integer",
    created_at: "datetime",
    updated_at: "datetime"
});

User({
    hash: "string",
    name: "string",
    nick: "string",
    updated_at: "datetime"
})
```

### APIs
* `POST /login`
* `GET /logout`
* `GET /profile`
* `GET /posts`
* `POST /posts`
* `PATCH /posts/{hash}`
* `GET /posts/{hash}`
* `DELETE /posts/{hash}`