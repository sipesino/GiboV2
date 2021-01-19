<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>Gibo</title>
</head>

<body>
    <main>
        <div class="container">
            <div>
                <h4>Due Today</h4>
                <ul>
                    @foreach($data as $task)
                    <li class="task">
                        <div class="content">
                            <div class="desc">
                                <p>{{$task->description}}</p>
                                @if($task->duedate != null)
                                <span>{{ \Carbon\Carbon::parse($task->duedate)->format('M d, Y | g:i A')}}</span>
                                @endif
                            </div>


                            <div class="btns" id="' . $task['duedate'] . '">
                                <div class="finEdit" id="' . $task['taskNo'] . '">
                                    <button class="finished" name="finished">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    <button class="edit" name="edit" id="' . $task['description'] . '">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="delete" name="delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>

            </div>
            <div>

            </div>
            <div>

            </div>
            <div>

            </div>
        </div>
        <div class="header">
            <h1 id="title"><a href="#">gibo</a></h1>
            <p class="totalTasks">{{count($data)}}</p>
            <h5>Active Task(s)</h5>
            <button class="addBtn">+</button>
        </div>
        <div class="bg-modal">
            <div class="modal-content">
                <h4>Add Task</h4>
                <form method="POST" action="{{url('')}}" autocomplete="off">
                    {{csrf_field()}}
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>
                    <div class="duedate">
                        <input type="checkbox" name="check" id="check" />
                        <label for="duedate">Due Date</label>
                        <input type="datetime-local" name="duedate" id="duedate" />
                    </div>
                    <input type="submit" value="Add" class="add" />
                    <input type="button" value="Cancel" class="cancel" />
                </form>
            </div>
        </div>
        <div class="bg-modal-edit">
            <div class="modal-content-edit">
                <h4>Edit Task</h4>
                <form method="POST" action="edit.php" autocomplete="off">
                    <input type="text" name="id" id="taskNo">
                    <textarea name="description" id="descriptionE" cols="30" rows="10" placeholder="Description" required></textarea>
                    <div class="duedate">
                        <input type="checkbox" name="check" id="checkE" />
                        <label name="" for="duedate" id="lbl">Due Date</label>
                        <input type="datetime-local" name="duedate" id="duedateE" />
                    </div>
                    <input type="submit" value="Confirm" class="confirm" />
                    <input type="button" value="Cancel" class="cancel" />
                </form>
            </div>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/be44f73e1b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>

</html>