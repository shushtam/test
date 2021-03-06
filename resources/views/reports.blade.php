@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" >
        <div class="col-md-2" style="background-color: rgb(217, 217, 217);border-radius: 5px;padding: 30px;">
            <ul class="nav nav-pills nav-stacked">
                <?= Form::open(array('method' => 'get', 'url' => 'user/report', 'class' => 'form-horizontal', 'role' => 'form')) ?>
                <?= csrf_field() ?>
                <li class="page-header"><h2>Search</h2></li>
                <div class="form-group<?= $errors->has('name') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('name', 'Name:') ?>
                        <?= Form::input('text', 'name', old('name'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('name')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('name') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('email', 'Email:') ?>
                        <?= Form::input('email', 'email', old('email'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('email') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <li>
                        <?= Form::label('role', 'Role:') ?>
                        <?= Form::select('role', ['' => 'Select Role'] + App\Models\User::getRoleList(), old('role'), ['class' => 'form-control', 'style' => 'margin-bottom:80px']) ?>
                    </li>
                </div>
                <div class="form-group<?= $errors->has('min_value') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('minvalue', 'From:') ?>
                        <?= Form::input('number', 'min_value', old('min_value'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('min_value')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('min_value') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group<?= $errors->has('max_value') ? ' has-error' : '' ?>">
                    <li>
                        <?= Form::label('maxvalue', 'To:') ?>
                        <?= Form::input('number', 'max_value', old('max_value'), ['class' => 'form-control']) ?>
                    </li>
                    <?php if ($errors->has('max_value')): ?>
                        <span class="help-block">
                            <strong><?= $errors->first('max_value') ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <li class="text-center">
                        <?= Form::input('submit', 'search', 'search', ['class' => 'btn btn-warning', 'style' => 'width: 100px']) ?>
                    </li>
                </div>
                <?= Form::close() ?>
            </ul>
        </div>
        <div class="col-md-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Reports</h2>
                </div>
                <div class="panel-body">
                    <table style="overflow: visible" border="1" class="table table-hover" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Values</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody style="overflow: visible">
                            <?php foreach ($userGroupedArr as $userObj): ?>
                                <tr style="overflow: visible" data-user-id="<?= $userObj['id'] ?>">
                                    <td><?= $userObj['id']?></td>
                                    <td><?= $userObj['name'] ?></td>
                                    <td><?= $userObj['email'] ?></td>
                                    <td><?= $userObj['role'] ?></td>
                                    <?php if ($userObj['total_values'] == '') : ?>
                                        <td>0</td>
                                    <?php else : ?>
                                        <td><?= $userObj['total_values'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($userObj['report_date'] == '') : ?>
                                        <td>0</td>
                                    <?php else : ?>
                                        <td><?= $userObj['report_date'] ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <?= $userGroupedArr->appends(Request::only('name', 'email', 'role', 'min_value', 'max_value'))->render(); ?>
        </div>
    </div>
</div>

@endsection
