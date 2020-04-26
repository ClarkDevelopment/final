<div class="modal fade" id="request_quote_modal" style="top:30% !important" tabindex="-1" role="dialog"
     aria-labelledby="request_quote_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Add Quote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body" id="classContent">
                <form name="requestQuoteAdd" id="requestQuoteAdd" action="index.php?action=request_quote" method="post">
                    <div class="row justify-content-center mt-4">
                        <div class="col-10 text-center">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Quote Text" name="text"
                                       id="text">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-10">
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select a Category</option>
                                    <?php
                                    if (isset($categories) and count($categories)) {
                                        foreach ($categories as $category) {
                                            print "<option value='" . $category['id'] . "'>" . proper($category['category']) . "</option>\n";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="form-group">
                                <select class="form-control" name="author" id="author">
                                    <option value="">Select an Author</option>
                                    <?php
                                    if (isset($authors) and count($authors)) {
                                        foreach ($authors as $author) {
                                            print "<option value='" . $author['id'] . "'>" . proper($author['author']) . "</option>\n";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-form display-4" id="rr_modal_request_quote">Request Quote
                </button>
            </div>
        </div>
    </div>
</div>