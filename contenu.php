        <!-- ADD todo FORM -->
        <div id= "todo-list" class="container section grey lighten-5">
            <h2 class="center-align">Todo List</h2>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <!-- todo yet to do -->
                    <form action="" method="POST" class="todos">
                        <p>
                            <label>
                                <input type="checkbox" />
                                <span>Complete todo challenge</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" checked="checked"/>
                                <span>Go to sleep early</span>
                            </label>
                        </p>
                        <div class="input-field left-align">
                            <button class="btn waves-effect waves-light orange" type="submit" name="submit" value="submit">Submit</button>
                        </div>
                    </form>
                    <!-- todo completed -->
                    <h5 id="completed">Completed todos</h5>
                    <form action="" method="" class="completed">
                        <p>
                            <label>
                                <input type="checkbox" checked="checked" disabled="disabled" />
                                <span><strike>Eat lunch</strike></span>
                            </label>
                        </p>
                    </form>
                </div>
            </div>
        </div>