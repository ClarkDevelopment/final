<?php include("view/header_admin.php"); ?>
<div class="container">
    <div class="row mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="text-center">Category</th>
                <th scope="col" class="text-center">Options</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($categories) and count($categories)) {
                foreach ($categories as $category) {
                    print "<tr>\n";
                    print "<td align='center'>" . proper($category['category']) . "</td>\n";
                    print "<td align='center'><a href='admin.php?action=delete_category&id=" . $category['id'] . "' 
                                  class='btn btn-danger'>Delete</a></td>\n";
                }
            } else {
                print "<tr>\n";
                print "<td colspan='2'>No Category currently available</td>\n";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-primary mt-5" id="addCategory">Add Category</button>
    </div>
    <div class="row text-center mt-3 mb-5">
        <div class="col">
            <a href="admin.php">Return to Quote List</a><BR>
            <a href="admin.php?action=view_authors">View/Edit Authors</a>
        </div>
    </div>
</div>
<section>
    <?php include("modals/admin/modal_register.html"); ?>
    <?php include("modals/admin/modal_category.html"); ?>
    <?php include("modals/common/modal_general.html"); ?>
    <?php include("modals/common/modal_response_errors.html"); ?>
</section>
<?php include("view/footer_admin.html"); ?>
