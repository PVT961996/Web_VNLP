<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Demo right click</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300);

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            color: #595959;
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            font-weight: 300;
            line-height: 1.5;
        }

        .container {
            margin: 0 auto;
            padding: 0 24px;
            max-width: 960px;
        }

        /* primary header */

        .primary-header {
            padding: 24px 0;
            text-align: center;
            border-bottom: solid 2px #cfcfcf;
        }

        .primary-header__title {
            color: #393939;
            font-size: 36px;
        }

        .primary-header__title small {
            font-size: 18px;
            color: #898989;
        }

        /* content */

        .content {
            padding: 48px 0;
            border-bottom: solid 2px #cfcfcf;
        }

        .content__footer {
            margin-top: 12px;
            text-align: center;
        }

        /* footer */

        .primary-footer {
            padding: 24px 0;
            color: #898989;
            font-size: 14px;
            text-align: center;
        }

        /* tasks */

        .tasks {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .task {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: solid 1px #dfdfdf;
        }

        .task:last-child {
            border-bottom: none;
        }

        /* context menu */

        .context-menu {
            display: none;
            position: absolute;
            z-index: 10;
            padding: 12px 0;
            width: 240px;
            background-color: #fff;
            border: solid 1px #dfdfdf;
            box-shadow: 1px 1px 2px #cfcfcf;
        }

        .context-menu--active {
            display: block;
        }

        .context-menu__items {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .context-menu__item {
            display: block;
            margin-bottom: 4px;
        }

        .context-menu__item:last-child {
            margin-bottom: 0;
        }

        .context-menu__link {
            display: block;
            padding: 4px 12px;
            color: #0066aa;
            text-decoration: none;
        }

        .context-menu__link:hover {
            color: #fff;
            background-color: #0066aa;
        }
    </style>
</head>
<body>
<header class="primary-header">
    <div class="container">
        <h1 class="primary-header__title">
            My Tasks App <small>using custom context menus</small>
        </h1>
    </div>
</header>
<main class="content">
    <div class="container">
        <ul class="tasks">
            <li class="task" data-id="3">
                <div class="task__content">
                    Go To Grocery
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
            <li class="task" data-id="2">
                <div class="task__content">
                    Type Some Code
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
            <li class="task" data-id="1">
                <div class="task__content">
                    Build An App
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
        </ul>
        <div class="content__footer">
            <button>Add A New Task</button>
        </div>
    </div>
</main>
<footer class="primary-footer">
    <div class="container">
        <small>&copy; 2015, Context Menu Madness!</small>
    </div>
</footer>
<nav id="context-menu" class="context-menu">
    <ul class="context-menu__items">
        <li class="context-menu__item">
            <a href="#" class="context-menu__link" data-action="View"><i class="fa fa-eye"></i> View Task</a>
        </li>
        <li class="context-menu__item">
            <a href="#" class="context-menu__link" data-action="Edit"><i class="fa fa-edit"></i> Edit Task</a>
        </li>
        <li class="context-menu__item">
            <a href="#" class="context-menu__link" data-action="Delete"><i class="fa fa-times"></i> Delete Task</a>
        </li>
    </ul>
</nav>
<script src="js/right-click.js"></script>
</body>
</html>
