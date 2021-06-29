jQuery(document).ready(($) => {
  /**
   * Add News Ajax
   * Get all values from Field
   */
  let formDiv = $("#addPostUsingRestApi");
  let submitForm = formDiv.find("form");
  submitForm.submit((e) => {
    e.preventDefault();
    let newsTitle = submitForm.find("#newsTitle").val();
    let newsType = submitForm.find("#newsTypes").val();
    let reporterName = submitForm.find("#reporterName").val();
    let reporterCity = submitForm.find("#reporterCity").val();
    let reporterGender = submitForm.find("#reporterGender").val();
    let newsContent = submitForm.find("#newsContent").val();
    let pictureFile = submitForm.find("#exampleFormControlFile1")[0].files[0];
    let data = {
      newsTitle,
      newsType,
      reporterName,
      reporterCity,
      reporterGender,
      newsContent,
      action: "add_new_news",
    };
    jQuery.ajax({
      url: submit_News_obj.siteUrl + "/wp-json/news/add-new-news",
      method: "POST",
      data: data,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        let formData = new FormData();
        formData.append("newsBanner", pictureFile);
        formData.append("newsID", response);
        formData.append("action", "save_image");
        if (response) {
          jQuery.ajax({
            url: submit_News_obj.siteUrl + "/wp-json/news/save-thumbail-image",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              alert("Successfully upload new news");
            },
          });
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Something went wrong in saving news");
      },
    });
  });

  /**
   * Delete News Ajax
   *
   */
  $(".newsDeleteForm").on("submit", function (e) {
    e.preventDefault();
    let form = $(this);
    if (confirm("Are you sure you want to delete this")) {
      let postId = form.find("#newsDel").attr("postId");
      let posted_id = { postId, action: "delete_news" };
      console.log(posted_id);
      jQuery.ajax({
        url: submit_News_obj.siteUrl + "/wp-json/news/delete-news",
        method: "POST",
        data: posted_id,
        caches: false,
        dataType: "json",
        encode: true,
        success: function (response) {
          let parentDiv = form.closest(".parentDiv");
          parentDiv.remove();
          alert("Deleted Successfully");
        },
        error: function (jqXHR, error, errorThrown) {
          console.log("Error in Deleting news");
        },
      });
    }
  });

  /**
   * Update News Ajax
   * Get all values from Field
   */
  let forUpdate = $("#forUpdate");
  let updateForm = forUpdate.find("form");
  updateForm.submit((e) => {
    e.preventDefault();
    let newsTitle = updateForm.find("#newsTitle").val();
    let newsType = updateForm.find("#newsTypes").val();
    let reporterName = updateForm.find("#reporterName").val();
    let reporterCity = updateForm.find("#reporterCity").val();
    let reporterGender = updateForm.find("#reporterGender").val();
    let newsContent = updateForm.find("#newsContent").val();
    let postId = updateForm.find("#submit").attr("postId");
    let dataToBeUpdated = {
      postId,
      newsTitle,
      newsType,
      reporterName,
      reporterCity,
      reporterGender,
      newsContent,
      action: "update_news",
    };
    jQuery.ajax({
      url: submit_News_obj.siteUrl,
      method: "POST",
      data: dataToBeUpdated,
      caches: false,
      dataType: "json",
      encode: true,
      success: function (response) {
        if (response) {
          alert("Update news successfully");
        } else {
          alert("Error in updating news");
        }
      },
      error: function (jqXHR, error, errorThrown) {
        console.log("Error in finding news");
      },
    });
  });
});
