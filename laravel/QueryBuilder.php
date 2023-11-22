<?php
use Illuminate\Support\Facades\DB;

$allUsers = DB::table('users')->get(); // Collection из stdClass obj
$firstUser = DB::table('users')->where('name', 'Ivan')->first(); // stdClass obj

$email = DB::table('users')->whrere('name', 'Ivan')->value('email'); // одно значение столбца email

$arrayOfValues = DB::table('users')->pluck('email'); // [0 => 'email1@ya.ru', 1 => 'email2@ya.ru']
$arrayOfValues = DB::table('users')->pluck('email', 'name'); // ['Ivan' => 'email1@ya.ru', 'Anna' => 'email2@ya.ru']

/******************
 * Chunking Results
 *****************/
// Этот метод извлекает небольшой фрагмент результатов за раз и передает каждый фрагмент в замыкание
DB::table('users')->orderBy('id')->chunk(100, function (Collection $users) {
    foreach ($users as $user) { ... }
});
// Если в чанке обновление извлеченных записей, лучше исп. chunkById
DB::table('users')->where('active', false)->chunkById(100, function (Collection $users) {
    foreach ($users as $user) { DB::table('users')->where('id', $user->id)->update(['active' => true]);}
});

// lazy работает аналогично методу chunk, но он возвращает LazyCollection, который позволяет вам взаимодействовать с результатами в виде единого потока
DB::table('users')->orderBy('id')->lazy()->each(function (object $user) {
    echo $user->name . PHP_EOL;
});
// аналогично, если в lazy обновление извлеченных записей, лучше lazyById or lazyByIdDesc

/************
 * Aggregates
 ***********/
$usersCount = DB::table('users')->count();
$maxPrice = DB::table('orders')->max('price');

/*************************
 * Exists - есть ли записи
 ************************/
DB::table('users')->where('email', 'ya@ya.ru')->exists(); // doesntExist

/*************************
 * Select
 ************************/
$users = DB::table('users')->select('id as user_id', 'email')->get(); // получаем только id и email's
$users = DB::table('users')->select('name')->distinct()->get(); // записи с уникальными name

/*************************
 * JOIN
 ************************/
$users = DB::table('posts')
    ->select('posts.*', 'users.email')
    ->join('users', 'posts.id', '=', 'users.id') // inner join, есть leftJoin, rightJoin, crossJoin (произведение, круги закрашены)
    ->where('users.id', '<', 12)
    ->get();

/*************************
 * WHERE
 ************************/
DB::table('posts')->where('votes', '<>', 100)->get();
DB::table('posts') ->where('name', 'like', 'T%')->get();
DB::table('users')->where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
])->get();

DB::table('posts')
    ->where('title', 'Ha ha')
    ->orWhere(function (Builder $query) {
        $query->where('id', '<', 20)
            ->orWhere('id', '=', '30');
    })->get();

DB::table('users')->where('votes', '>', 100)->orWhere('name', 'John')->get();

DB::table('users')->where('preferences->dining->meal', 'salad')->get(); // json
$users = DB::table('posts')->whereBetween('id', [1, 20])->get();
DB::table('users')->whereIn('id', [1, 2, 3])->get();
DB::table('users')->whereNull('updated_at')->get();

// whereDate / whereMonth / whereDay / whereYear / whereTime
DB::table('users')->whereDate('created_at', '2016-12-31')->get();

/*************************
 * Ordering, Grouping, Limit & Offset
 ************************/
$users = DB::table('posts')
    ->orderBy('title', 'asc')
    ->limit(2)
    ->get();

$users = DB::table('posts')->latest()->first(); // latest - orderBy($column, 'desc')
$users = DB::table('posts')->inRandomOrder()->first(); // случайный пользователь

$users = DB::table('users')
    ->groupBy('account_id')
    ->having('account_id', '>', 100)
    ->get();

$users = DB::table('users')
    ->offset(10)
    ->limit(5)
    ->get();

/*************************
 * Insert to DB - работает напрямую, без fillable
 ************************/
DB::table('users')->insert(['email' => 'kayla@example.com', 'votes' => 0]);
DB::table('users')->insert([
    ['email' => 'picard@example.com', 'votes' => 0],
    ['email' => 'janeway@example.com', 'votes' => 0],
]);

// insertOrIgnore

/*************************
 * Upsert DB - вставить, если нет или обновить сразу несколько
 * 1-й аргумент - массив значений
 * 2-й - идентифицирующие столбцы
 * 3-й - какие столбцы обновлять в случае обновления
 ************************/
DB::table('flights')->upsert(
    [
        ['departure' => 'Oakland', 'destination' => 'San Diego', 'price' => 99],
        ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
    ],
    ['departure', 'destination'],
    ['price']
);

$user = DB::table('posts')
    ->where('title', 'Some title')
    ->update(['title' => 'Some title 2']); // return changed count

// Вставка или обновление, поиск по 1-му массиву, замена данными из 2-го
DB::table('users')
    ->updateOrInsert(
        ['email' => 'john@example.com', 'name' => 'John'],
        ['votes' => '2']
    );

$user = DB::table('posts')
    ->where('title', 'Some title 2')
    ->increment('likes', 5);

/*************************
 * Delete from DB
 ************************/

$deleted = DB::table('users')->delete();
$deleted = DB::table('users')->where('votes', '>', 100)->delete();
DB::table('users')->truncate(); // cascade

/*************************
 * Pessimistic Locking
 ************************/
