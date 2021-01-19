require("./bootstrap");
let duedate = $("#duedate");
duedate.value = "";

const { sortBy } = require("lodash");

$(".addBtn").on("click", function () {
    $(".bg-modal").css("display", "flex");
    $("#duedate").prop("disabled", true);
});

$("#check").on("change", function () {
    if (this.checked) {
        let today = new Date();
        let date =
            today.getFullYear() +
            "-" +
            (today.getMonth() + 1).toString().padStart(2, 0) +
            "-" +
            today.getDate().toString().padStart(2, 0);
        let time = adjust(today.getHours()) + ":" + adjust(today.getMinutes());
        duedate.val(date + "T" + time);
        $("#duedate").prop("disabled", false);
    } else {
        duedate.val("");
        $("#duedate").prop("disabled", true);
    }
});

$(".cancel").on("click", function () {
    $(".bg-modal").css("display", "none");
});

function adjust(v) {
    if (v > 9) {
        return v.toString();
    } else {
        return "0" + v.toString();
    }
}

function showAlert(alertObj, message, type = "error") {
    alertObj = !alertObj || !alertObj.length ? $(".alert-message") : alertObj;
    alertObj
        .removeClass("alert-success alert-error hidden")
        .addClass("alert-" + type)
        .show()
        .html(message);
}

function hideAlert(alertObj) {
    alertObj = !alertObj || !alertObj.length ? $(".alert-message") : alertObj;
    alertObj
        .removeClass("alert-success alert-error hidden")
        .addClass("alert-" + type)
        .hide()
        .html("");
}

function populateList(data) {
    var todoList = $("div.todo-list");
    if (data.response) {
        var list = data.data.data;
        for (idx in list) {
            var item = list[idx];
            var newUl = $("<ul></ul>", {});
            newUl.append(
                $("<li></li>", {
                    class: "task",
                }).append(
                    $("<div></div>", {
                        class: "content",
                    })
                        .append(
                            $("<div></div>", {
                                class: "desc",
                            })
                                .append($("<p></p>", {}).html(item.description))
                                .append(
                                    $("<span></span>", {}).html(item.duedate)
                                )
                        )
                        .append(
                            $("<div></div>", {
                                class: "btns",
                            }).append(
                                $("<div></div>", {
                                    class: "finEdit",
                                })
                                    .append(
                                        $("<button></button>", {
                                            class: "finished",
                                        }).append(
                                            $("<i></i>", {
                                                class: "far fa-check-square",
                                            })
                                        )
                                    )
                                    .append(
                                        $("<button></button>", {
                                            class: "edit",
                                            "data-id": item.taskNo,
                                        })
                                            .append(
                                                $("<i></i>", {
                                                    class: "fas fa-pencil-alt",
                                                })
                                            )
                                            .on("click", function () {
                                                var id = $(this).attr(
                                                    "data-id"
                                                );
                                                getTask(id);
                                            })
                                    )
                                    .append(
                                        $("<button></button>", {
                                            class: "delete",
                                        }).append(
                                            $("<i></i>", {
                                                class: "far fa-trash-alt",
                                            })
                                        )
                                    )
                            )
                        )
                )
            );
            todoList.append(newUl);
        }
    } else {
        todoList.html("No result");
    }
}

function loadList(
    params = { page: 1, limit: 5, id: "all", sortBy: "ASC", orderBy: "taskNo" }
) {
    $.get(
        "/sample/load/" +
            params.id +
            "?page=" +
            params.page +
            "&limit=" +
            params.limit +
            "&sortBy=" +
            params.sortBy +
            "&orderBy=" +
            params.orderBy
    )
        .done(function (data) {
            populateList(data);
        })
        .fail(function () {
            populateList({ response: false });
        });
}

function loadCounter() {
    var divCounter = $("div.todo-list-counter");
    $.get("/sample/load/all?count=1")
        .done(function (data) {
            if (data.response) {
                divCounter.html(data.data);
            } else {
                divCounter.html("0");
            }
        })
        .fail(function () {
            divCounter.html("0");
        });
}

function addTodo(params = { description: "", duedate: "" }) {
    if (!params.description.length || !params.duedate.length) {
        showAlert(null, "Invalid parameters");
        return;
    }
    $.post("/sample/add", { params: params })
        .done(function (data) {
            var alertType = data.response ? "success" : "error";
            showAlert("", data.message, alertType);
            loadCounter();
            loadList();
        })
        .fail(function () {
            showAlert("", "Something went wrong");
        });
}

function getTask(id) {
    $.get("/sample/load/" + id).done(function (data) {
        if (data.response) {
            $("modal-content-edit")
                .find("input#description")
                .val(data.data.description);
            $("modal-content-edit")
                .find("input#duedate")
                .val(data.data.duedate);
        } else {
            showAlert("", "Failed to retrieve task ID: " + id);
        }
    });
}

$(function () {
    loadList();
    loadCounter();

    $("#btnSave").on("click", function () {
        var inputs = $('form[name="frmAdd"]').find("input").serializeArray();
        var errors = 0;
        var params = {};
        for (idx in inputs) {
            var inputObj = $("#" + inputs[idx].name);
            if (inputObj.attr("required") !== undefined) {
                if (!inputs[idx].value.length) {
                    errors++;
                }
            }
            Object.assign(params, { [inputs[idx].name]: inputs[idx].value });
        }
        if (errors > 0) {
            showAlert("", "Please provide field values");
            return;
        }
        addTodo(params);
    });
});
