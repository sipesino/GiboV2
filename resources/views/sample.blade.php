<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>Gibo</title>
</head>

<body>

    <div class="todo-list"></div>
    <div class="header">
        <h1 id="title"><a href="#">gibo</a></h1>
        <div class="todo-list-counter"></div>
        <h5>Active Task(s)</h5>
        <button class="addBtn">+</button>
    </div>
    <div class="bg-modal">
        <div class="modal-content">
            <form name="frmAdd" action="#">
                <div class="form-body">
                    <div class="form-input-group">
                        <label>
                            <div class="form-label">Description</div>
                            <div class="form-input">
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>
                            </div>
                        </label>
                    </div>
                    <div class="form-input-group">
                        <div class="duedate">
                            <input type="checkbox" name="check" id="check" />
                            <label for="duedate">Due Date</label>
                            <input type="datetime-local" name="duedate" id="duedate" placeholder="Due Date" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button id="btnSave" type="button" class="add">Save</button>
                    <button id="btnReset" type="button" class="cancel">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-modal-edit">
        <div class="modal-content-edit">
            <h4>Edit Task</h4>
            <form name="frmEdit" action="#" autocomplete="off">
                <div class="form-body">
                    <div class="form-input-group">
                        <label>
                            <div class="form-label">Description</div>
                            <div class="form-input">
                                <input type="text" id="description" name="description" placeholder="Task description" required />
                            </div>
                        </label>
                    </div>
                    <div class="form-input-group">
                        <div class="duedate">
                            <input type="checkbox" name="check" id="check" />
                            <label for="duedate">Due Date</label>
                            <input type="datetime-local" name="duedate" id="duedate" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button id="btnUpdate" type="button" class="confirm">Update</button>
                    <button id="btnReset" type="button" class="cancel">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <div class="alert-message hidden"></div>
    <script src="https://kit.fontawesome.com/be44f73e1b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>