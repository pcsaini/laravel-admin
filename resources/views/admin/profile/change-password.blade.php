<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form role="form" action="{{ route('admin.change_password') }}" id="changePasswordForm" method="POST"
                  data-parsley-validate>
                <div class="modal-header">
                    <h4 class="modal-title" id="changePasswordLabel">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password"
                               data-parsley-trigger="focusout"
                               data-parsley-required
                               data-parsley-required-message="Please enter current password"
                               placeholder="Enter Current Password">
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               data-parsley-trigger="focusout"
                               data-parsley-required
                               data-parsley-required-message="Please enter new password"
                               placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                               data-parsley-trigger="focusout"
                               data-parsley-required
                               data-parsley-required-message="Please confirm new password"
                               placeholder="Enter Confirm Password">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#changePasswordForm').submit(function (e) {
            e.preventDefault();

            let data = $(this).serializeArray();
            let url = $(this).attr('action')
            let method = $(this).attr('method')

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function (res) {
                    if (res.status === true) {
                        $('#changePassword').modal('hide')
                        successAlert(res.message)
                    } else {
                        errorAlert(res.message)
                    }
                },
                error: function (e) {
                    errorAlert(e.responseJSON.message)
                }
            })
        })
    </script>
@endpush
