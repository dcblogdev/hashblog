# HashBlog

A sample Blog using Hashnode Public APIs.

This is the source code for the post https://hashnode.com/blog/showing-your-hashnode-blog-posts-on-your-laravel-blog-using-hashnode-public-apis

![Blog](https://github.com/dcblogdev/hashblog/assets/1018170/9ccceab6-9943-4c76-bcd3-54bc5fea5c7e)


## Installation

Clone the repo locally:

```bash
git clone git@github.com:dcblogdev/hashblog.git
```

Run composer install
```bash
composer install
```

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

Generate a Key:

```bash
php artisan key:generate
```

Set the Hashnode blog to use:

```
HASHNODE_HOST=your_hashnode_username
```

Install NPM:

```bash
npm install
```

Build the assets

```bash
npm run build
```

That's it! launch the app and see the posts.
