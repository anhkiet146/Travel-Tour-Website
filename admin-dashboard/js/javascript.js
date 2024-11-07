console.log("Nút đã được nhấn");

document.addEventListener("DOMContentLoaded", function () {
  let destinationCount = 1; // Đếm số điểm đến

  document
    .getElementById("addDestination")
    .addEventListener("click", function () {
      destinationCount++; // Tăng số đếm lên mỗi lần thêm điểm đến
      var container = document.getElementById("destinationContainer");
      var newRow = document.createElement("div");
      newRow.className = "row destination-entry mb-3"; // thêm class cho mỗi dòng

      // Thêm số thứ tự vào dòng mới
      newRow.innerHTML = `
      <h5 class="col-12">Điểm đến thứ ${destinationCount}</h5>
      <div class="col-md-6">
          <label for="MaDD[]" class="form-label">Mã Điểm Đến</label>
          <input class="form-control" type="text" name="MaDD[]" required>
      </div>
      <div class="col-md-6">
          <label for="TenDD[]" class="form-label">Tên Điểm Đến</label>
          <input class="form-control" type="text" name="TenDD[]" required>
      </div>
      <div class="col-md-12">
          <label for="MoTaDD[]" class="form-label">Mô tả Điểm Đến</label>
          <textarea class="form-control" name="MoTaDD[]"></textarea>
      </div>
      <div class="col-md-6">
          <label for="HinhAnhDD[]" class="form-label">Hình Ảnh Điểm Đến</label>
          <input class="form-control" type="file" name="HinhAnhDD[]">
      </div>
      <div class="col-md-6">
          <label for="ViTriDD[]" class="form-label">Vị Trí</label>
          <input class="form-control" type="text" name="ViTriDD[]" required>
      </div>
      <div class="col-md-6">
          <label for="SoNgay[]" class="form-label">Số Ngày Ở Điểm Đến</label>
          <input class="form-control" type="number" name="SoNgay[]" min="1">
      </div>
  `;

      container.appendChild(newRow); // thêm dòng mới vào container
    });
});

document.addEventListener("DOMContentLoaded", function () {
  let HotelCount = 1; // Đếm số điểm đến
  document.getElementById("addHotel").addEventListener("click", function () {
    HotelCount++;
    var container = document.getElementById("hotelContainer");
    var newEntry = document.createElement("div");
    newEntry.className = "row hotel-entry mb-3";
    newEntry.innerHTML = `
            <h5 class="col-12">Khách sạn thứ ${HotelCount}</h5>
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
        `;
    container.appendChild(newEntry);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let transportCount = 1; // Đếm số điểm đến
  document
    .getElementById("add-transport")
    .addEventListener("click", function () {
      transportCount++;
      var container = document.getElementById("transport-container");
      var newTransport = `
            <h5 class="col-12">Phương tiện thứ ${transportCount}</h5>
              <div class="row mb-3">
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
          `;
      container.insertAdjacentHTML("beforeend", newTransport);
    });
});
