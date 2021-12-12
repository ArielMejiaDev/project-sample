# Project Sample

Shows some very useful patterns with Laravel applications by a Blog API.

## Index 🗂️
- Commits & Patterns
- Setup project Instructions
- Credits

### Commits & Patterns 🤓

- Adding a macro to `TestResponse` object - [Here](https://github.com/ArielMejiaDev/project-sample/commit/1fa3c1737e923b4c6c1b09041d7937b7f509dd86)
- Add custom properties to make tests boilerplate shorter/easier and add traits to Laravel `TestCase` - [Here](https://github.com/ArielMejiaDev/project-sample/commit/aea7ac876ad1305be1bbc11a4f46f108bb0cae55)
- Resolve common model events with a general trait (bootable method) - [Here](https://github.com/ArielMejiaDev/project-sample/commit/57c75144d51a0ccea75a023e153ce04211ce338c)
- Dependency Injection, Custom Service Providers and Query Objects to handle `index` requests easier - [Here](https://github.com/ArielMejiaDev/project-sample/commit/4b10d8578eed3b3d1d9e3908534258eb792d4faa)
- Add API basic authentication & how to map new route files to keep all routes clean in `RouteServiceProvider` - [Here](https://github.com/ArielMejiaDev/project-sample/commit/4b10d8578eed3b3d1d9e3908534258eb792d4faa)
- Refactoring namespaces & follow a convention for services, controllers, etc - [Here](https://github.com/ArielMejiaDev/project-sample/commit/4074ffadc1639d6bd25ae1cf8e3cabead24304aa)
- Add trashed and search Eloquent model endpoint and how to test it - [Here](https://github.com/ArielMejiaDev/project-sample/commit/623d70bdb9f30c0329f35e014076fe6b311e2363)
- Add policies to any resource controller for your Authorization logic - [Here](https://github.com/ArielMejiaDev/project-sample/commit/0cf2d0a8bb73c15742b562da09678426e2d1b418)
- Add `Eloquent builders` to reduce `Eloquent models` size - [Here](https://github.com/ArielMejiaDev/project-sample/commit/09a458560b491f099689aeedc440a6e5c0d94675)
- How to add a single class macro - [Here](https://github.com/ArielMejiaDev/project-sample/commit/df4b4b82284032249a92f139e1724646e1fc96a1)
- Refactoring tests (using relationship helpers) - [Here](https://github.com/ArielMejiaDev/project-sample/commit/e94d2f43243faa257fc2a64d5cbff5f2961156c0)
- Refactoring a Macro closure to Mixin - [Here](https://github.com/ArielMejiaDev/project-sample/commit/b61b49236775e2b474e9fc161b7a7f01b94b994e)
- Refactoring a Mixin to single class Macro - [Here](https://github.com/ArielMejiaDev/project-sample/commit/c2366bca8fdad3d819cae77cc565258b760852fc)
- Add new model fields workflow & register policies in `AuthServiceProvider` - [Here](https://github.com/ArielMejiaDev/project-sample/commit/1a4e2b4472a2a90b7a4e6579417ffa5878bc809e)
- How to test timestamps - [Here](https://github.com/ArielMejiaDev/project-sample/commit/128058343b53c72545db0cf7e1c5b398703bf3dc)
- How to use as external service, How to implement a strategy & factory patterns in Laravel to handle different "types" of outputs & add and endpoint with multiple filters - [Here](https://github.com/ArielMejiaDev/project-sample/commit/ab8311de153ec4e831e0af795323089fc717bccb)


### Setup Instructions 🚀

- You need some Development environment to work with Laravel you can use Valet or Sail.
- Clone the project: `git clone git@github.com:ArielMejiaDev/project-sample.git`
- Create an env file (check that you are in the root directory of the project): `cp .env.example .env`
- Set your Database driver (it is already set for SQLite to make the project setup easier).
- You can set a database with Mysql or SQLite to test that everything is working.
  - The easiest way is to make a SQLite Database in your terminal:
    ```
    cd database
    touch database.sqlite
    ```
- To test the endpoints you can use POSTMAN, here is a Postman Collection link to test it manually easier: [Here](https://www.getpostman.com/collections/b2e0f5f70be685e2970f)

### Credits ⭐

- Author [ArielMejiaDev]()
- Special thanks to all the Laravel team core members and Spatie team.
