<style>
    input {
        padding: 11px 20px 10px;
    }

    select {
        padding: 9px 14px 10px;
    }
</style>
<div class="container-fluid py-4">
    <!-- <div class="row"> -->
    <div id="form-add-admin" class="card " hidden>
        <div class="card-header p-2">
            <h6 class="mb-0" style="font-family: 'FontAwesome';">Add Admin</h6>
        </div>
        <div class="card-body pb-1">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12 mt-3 p-0">
                    <div class="input-wrapper">
                        <input type="text" id="nama" required>
                        <label for="nama">Name</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mt-3 p-0">
                    <div class="input-wrapper">
                        <input type="text" id="username" required>
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mt-3 p-0">
                    <div class="input-wrapper">
                        <input type="text" id="password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12 mt-3 p-0">
                    <div class="input-wrapper">
                        <label for="role">Privilage</label>
                        <select type="text" id="role" required>
                            <option value="">Pilih ...</option>
                            <option value="Admin">Admin</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="select-role" class="row" hidden>
                <div class="col-lg-3 col-md-3 col-12 mt-3 p-0">
                    <div class="input-wrapper">
                        <label for="role-perum">Add role</label>
                        <select type="text" id="role-perum" required>
                            <option value="">Pilih Perumahan</option>
                            <?php
                            foreach ($get_perum as $data) :
                            ?>
                                <option value="<?= $data->id_perum; ?>"><?= $data->nm_perum; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <button type="button" id="btn-cencel-add-admin" class="btn btn-sm btn-danger">Cencel</button>
                </div>
                <div class="col-6">
                    <button type="button" id="btn-save-admin" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header p-2">
            <div class="row">
                <div class="col-6">
                    <h6 class="mb-0" style="font-family: 'FontAwesome';">Data Admin</h6>
                </div>
                <div class="col-6">
                    <button type="button" id="btn-add-admin" class="btn btn-sm bg-gradient-primary float-right mb-0">Add Admin</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perumahan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody id="data-admin">

                </tbody>
            </table>
        </div>
    </div>
    <!-- </div> -->
</div>

<!-- Button trigger modal -->