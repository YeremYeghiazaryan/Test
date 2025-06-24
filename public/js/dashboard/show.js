function delete_post(button) {
    let post_id = $(button).data('post-id');
    $.ajax({
        method: "POST",
        url: '/api/post/destroy',
        data: {
            'post_id': post_id,
        },
        success: function (response) {
            if (response.status === true) {
                alert(response.message);
                $("#posts #post_" + post_id).remove();
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('Error Delete Post');
        }
    });
}

$(document).on('auth-checked', function () {
    let website_id = $('#website-data').data('website-id');
    $.ajax({
        method: "GET",
        headers: {
            Authorization: "Bearer " + getCookie('auth_token')
        },
        url: '/api/website/show/' + website_id,
        success: function () {
            $('#container').removeClass('d-none')
        },
        error: function (xhr) {
            alert(JSON.parse(xhr.responseText).message)
            window.location.href = '/dashboard';
        }
    });
    $.ajax({
        method: "GET",
        url: '/api/post/show',
        data: {
            'website_id': website_id,
        },
        success: function (response) {
            if (response.status === true) {
                let datas = response.data;
                let post = "";
                for (let data of datas) {
                    post += `
                        <tr id="post_${data.id}">
                            <th scope="row">${data.id}</th>
                            <td>${data.name}</td>
                            <td>${data.title}</td>
                            <td>${data.created_at}</td>
                            <td>${data.verified === 1 ? 'yes' : 'no'}</td>
                                    <td>
                                        <button onclick="delete_post(this)" type="submit" data-post-id="${data.id}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                }
                $("#posts").html(post);
            }
        },
        error: function () {

            alert('Eror Show Posts');
        }
    });


});


