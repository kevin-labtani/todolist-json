        <!-- ADD todo FORM -->
        <div id= "" class="container section grey lighten-5">
            <h4 class="center-align">Add a new todo</h4>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <form action="" method="POST" class="add-todo">
                        <!-- new todo-->
                        <div class="input-field">
                            <label for="new-todo" class="grey-text text-darken-4">Enter new todo</label>
                            <textarea
                                name="new-todo"
                                class="materialize-textarea"
                                id="new-todo"
                                data-length="200"
                                required
                            ><?php echo $SanitizedResult['new-todo'] ?? ''; ?></textarea>
                            <div class="red-text"><?php echo $errors['new-todo'] ?? ''; ?></div>
                        </div>
                        <div class="input-field center">
                            <button class="btn-large waves-effect waves-light orange" type="submit" name="add" value="add">Add New Todo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>