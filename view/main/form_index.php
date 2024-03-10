<?php include_once "form_header.php"?>

<body>
    <div id="div-container">

        <div class="card">
            <h3 class="card-header">
                Form
            </h3>
            <div class="card-body">
                <form id="form-creds" autocomplete="off">
                    <input id="in-fname" name="firstname" placeholder="First Name" type="text">
                    <input id="in-lname" name="firstname" placeholder="Last Name" type="text">
                    <textarea id="txt-address" name="address" placeholder="Address"></textarea>
                    <input id="in-bday" name="birthday" type="date">
                    <input id="in-age" name="age" placeholder="Age" type="number">
                </form>
                <div id="div-btns">
                    <button type="button" class="btn btn-primary" id="btn-sub" data-action="create">SUBMIT</a>
                    <button type="button" class="btn btn-primary" id="btn-clr">CLEAR</a>
                </div>
            </div>
        </div>

        <div id="table-container">
            <table class="table" id="tbl-tbl">
                <thead>
                    <tr>
                        <div id="div-search">
                            <input type="text" placeholder="Search by Last Name..." id="in-search">
                            <button class="btn btn-primary btn-search-style" id="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <button class="btn btn-primary btn-search-style" id="btn-clr-tbl"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Address</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Age</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbl-tbody">
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Otto</td>
                        <td>
                            <button class="btn btn-primary">EDIT</button>
                            <button class="btn btn-primary">DELETE</button>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>

    </div>
</body>

<?php include_once "form_footer.php"?>