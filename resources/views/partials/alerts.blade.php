  @if (session('success'))
      <div class="row justify-content-center">
          <div class="col-md-5">
              <div class="alert alert-success alert-dismissible fade show">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
      </div>
  @endif
  @if (session('error'))
      <div class="row justify-content-center">
          <div class="col-md-5">
              <div class="alert alert-danger alert-dismissible fade show">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
      </div>
  @endif
