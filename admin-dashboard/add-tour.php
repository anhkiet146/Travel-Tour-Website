
                     <!-- Khách sạn -->
                     <h3 class="mt-5">Thông tin khách sạn</h3>
                     <div id="hotelContainer">
                        <div class="row hotel-entry mb-3">
                        <h5 class="col-12">Khách sạn thứ 1</h5>
                           <div class="col-md-6 mb-3">
                                 <label for="MaLuuTru[]" class="form-label">Mã Khách Sạn</label>
                                 <input class="form-control" type="text" name="MaLuuTru[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="TenLuuTru[]" class="form-label">Tên Khách Sạn</label>
                                 <input class="form-control" type="text" name="TenLuuTru[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="GiaMotDem[]" class="form-label">Giá Một Đêm</label>
                                 <input class="form-control" type="number" step="0.01" name="GiaMotDem[]">
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="Rating[]" class="form-label">Đánh Giá</label>
                                 <input class="form-control" type="number" step="0.1" name="Rating[]">
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="LoaiPhong[]" class="form-label">Loại Phòng</label>
                                 <input class="form-control" type="text" name="LoaiPhong[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="SoDienThoai[]" class="form-label">Số Điện Thoại</label>
                                 <input class="form-control" type="text" name="SoDienThoai[]" required>
                           </div>
                           <div class="col-md-6 mb-3">
                                 <label for="NgayO[]" class="form-label">Ngày Ở</label>
                                 <input class="form-control" type="date" name="NgayO[]" required>
                           </div>
                        </div>
                     </div>
                     <button type="button" class="btn btn-secondary" id="addHotel">Thêm Khách Sạn +</button>


                     <h3 class="mt-5">Thông tin phương tiện</h3>
                     <div id="transport-container">
                        <div class="row mb-3">
                        <h5 class="col-12">Phương tiện thứ 1</h5>
                           <div class="col-md-6">
                                 <label for="MaPT" class="form-label">Mã Phương Tiện</label>
                                 <input class="form-control" type="text" name="MaPT[]" required>
                           </div>
                           <div class="col-md-6">
                                 <label for="TenPT" class="form-label">Tên Phương Tiện</label>
                                 <input class="form-control" type="text" name="TenPT[]" required>
                           </div>
                           <div class="col-md-12">
                                 <label for="MoTaPT" class="form-label">Mô tả Phương Tiện</label>
                                 <textarea class="form-control" name="MoTaPT[]"></textarea>
                           </div>
                        </div>
                     </div>
                     <button type="button" class="btn btn-secondary" id="add-transport">Thêm Phương Tiện +</button>


                     <!-- Khuyến mãi -->
                     <h3 class="mt-5">Thông tin khuyến mãi</h3>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                              <label for="MaKM" class="form-label">Mã Khuyến Mãi</label>
                              <input class="form-control" type="text" name="MaKM">
                        </div>
                        <div class="col-md-6 mb-3">
                              <label for="TenKM" class="form-label">Tên Khuyến Mãi</label>
                              <input class="form-control" type="text" name="TenKM">
                        </div>
                        <div class="col-md-6 mb-3">
                              <label for="HanSuDung" class="form-label">Hạn Sử Dụng</label>
                              <input class="form-control" type="date" name="HanSuDung">
                        </div>
                     </div>

                     <h3 class="mt-5">Thông tin lịch trình tour</h3>
                     <div class="row mb-3">
                        <div class="col-md-6">
                           <label for="MaLT" class="form-label">Mã Lịch Trình</label>
                           <input class="form-control" type="text" name="MaLT" required>
                        </div>
                        <div class="col-md-6">
                           <label for="FileLT" class="form-label">File Lịch Trình</label>
                           <input class="form-control" type="file" name="FileLT" required>
                        </div>
                     </div>
                     
                     <h3 class="mt-5">Thông tin loại tour</h3>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                           <label for="MaLoai" class="form-label">Mã Loại Tour</label>
                           <input class="form-control" type="text" name="MaLoai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="TenLoai" class="form-label">Tên Loại Tour</label>
                           <input class="form-control" type="text" name="TenLoai" required>
                        </div>
                        <div class="col-md-12 mb-3">
                           <label for="MoTa" class="form-label">Mô Tả</label>
                           <textarea class="form-control" name="MoTa" rows="4"></textarea>
                        </div>
                     </div>

                     <!-- Thêm thông tin điểm xuất phát -->
                     <h3 class="mt-5">Thông tin điểm xuất phát</h3>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                           <label for="MaDXP" class="form-label">Mã Điểm Xuất Phát</label>
                           <input class="form-control" type="text" name="MaDXP" required>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="TenDXP" class="form-label">Tên Điểm Xuất Phát</label>
                           <input class="form-control" type="text" name="TenDXP" required>
                        </div>
                        <div class="col-md-12 mb-3">
                           <label for="DiaChi" class="form-label">Địa Chỉ</label>
                           <textarea class="form-control" name="DiaChi" rows="4"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                           <label for="MoTa" class="form-label">Mô Tả</label>
                           <textarea class="form-control" name="MoTa" rows="4"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="ThoiGianXP" class="form-label">Thời Gian Xuất Phát</label>
                           <input class="form-control" type="time" name="ThoiGianXP">
                        </div>
                     </div>

