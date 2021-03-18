<div class="modal fade" tabindex="-1" role="dialog" id="bookModal">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form action="{{ url('book') }}" method="post" id="bookForm">
              @csrf
              <div class="form-group">
                <label>Book Title</label>
                <input type="text" name="title" id="title" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" id="author" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <label>Date Publish</label>
                <input type="date" name="date_publish" id="date_publish" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <input type="hidden" name="id" id="book_id">
                <button class="btn btn-primary btn-sm">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="viewBookModal">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="card-body" id="card-content"></div>
          <div class="card-footer">
            <a href="javascript:;" class="btn btn-primary btn-sm float-right" data-dismiss="modal">Close</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>