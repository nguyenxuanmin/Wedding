<?php 
namespace App\Services;

class AdminService
{
    public function generateSlug($title) {
        $slug = strtolower($title);
        $slug = preg_replace('~[áàạảãâấầậẩẫăắằặẳẵ]~u', 'a', $slug);
        $slug = preg_replace('~[éèẹẻẽêếềệểễ]~u', 'e', $slug);
        $slug = preg_replace('~[íìịỉĩ]~u', 'i', $slug);
        $slug = preg_replace('~[óòọỏõôốồộổỗơớờợởỡ]~u', 'o', $slug);
        $slug = preg_replace('~[úùụủũưứừựửữ]~u', 'u', $slug);
        $slug = preg_replace('~[ýỳỵỷỹ]~u', 'y', $slug);
        $slug = preg_replace('~[đ]~u', 'd', $slug);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    public function generateImage($image,$folder) {
        $message = "";

        $targetFile = $folder.'/'. basename($image['name']);
        $uploadDir = public_path('storage/' . $folder . '/');
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($image["tmp_name"]);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if ($check === false) {
            $message = "Tệp không phải là hình ảnh.";
            return $message;
        }
        if (file_exists($targetFile)) {
            $message = "Xin lỗi, tệp này đã tồn tại.";
            return $message;
        }
        if ($image["size"] > 5000000) {
            $message = "Xin lỗi, tệp của bạn quá lớn.";
            return $message;
        }
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "webp") {
            $message = "Xin lỗi, chỉ các tệp JPG, JPEG, PNG, GIF, WEBP được phép.";
            return $message;
        }
        if (move_uploaded_file($image["tmp_name"], $uploadDir . basename($image['name']))) {
            return $message;
        } else {
            $message = "Có lỗi xảy ra khi tải tệp lên.";
            return $message;
        }
    }

    public function convertOembedToIframe($content){
        return preg_replace_callback(
            '/<oembed\s+url="([^"]+)"><\/oembed>/',
            function ($matches) {
                $url = $matches[1];

                if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                    parse_str(parse_url($url, PHP_URL_QUERY), $query);
                    $videoId = $query['v'] ?? basename(parse_url($url, PHP_URL_PATH));
                    return '<div class="video-wrapper"><iframe src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe></div>';
                }

                if (strpos($url, 'vimeo.com') !== false) {
                    $videoId = basename(parse_url($url, PHP_URL_PATH));
                    return '<div class="video-wrapper"><iframe src="https://player.vimeo.com/video/' . $videoId . '" frameborder="0" allowfullscreen></iframe></div>';
                }

                return '<a href="' . $url . '">' . $url . '</a>';
            },
            $content
        );
    }
}
