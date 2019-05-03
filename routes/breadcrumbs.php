<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('summary', function ($trail) {
    $trail->parent('home');
    $trail->push('Summary', route('summary'));
});

Breadcrumbs::for('income', function ($trail) {
    $trail->parent('summary');
    $trail->push('Income', route('income.index'));
});

Breadcrumbs::for('income-create', function ($trail) {
    $trail->parent('income');
    $trail->push('Create', route('income.create'));
});

Breadcrumbs::for('income-show', function ($trail, $income) {
    $trail->parent('income');
    $trail->push(ucfirst($income->subject), route('income.show', $income->id));
});

Breadcrumbs::for('expense', function ($trail) {
    $trail->parent('summary');
    $trail->push('Expenses', route('expense.index'));
});

Breadcrumbs::for('expense-create', function ($trail) {
    $trail->parent('expense');
    $trail->push('Create', route('expense.create'));
});

Breadcrumbs::for('expense-daily', function($trail, $date) {
    $trail->parent('expense');
    $trail->push($date, route('expense.daily', $date));
});

Breadcrumbs::for('expense-show', function ($trail, $expense) {
    $trail->parent('expense-daily', $expense->date);
    $trail->push(ucfirst($expense->subject), route('expense.show', $expense->id));
});

// Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
    // $trail->parent('category', $post->category);
    // $trail->push($post->title, route('post', $post->id));
// });
