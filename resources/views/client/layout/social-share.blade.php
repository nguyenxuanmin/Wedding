<div class="social-share">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank" class="facebook" title="Share Facebook">
        <i class="fa-brands fa-facebook-f"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?url={{url()->current()}}&text={{$titlePage}}" target="_blank" class="twitter" title="Share Twitter">
        <i class="fa-brands fa-twitter"></i>
    </a>
    @if (!empty($imageShare))
        <a href="https://www.pinterest.com/pin/create/button/?url={{url()->current()}}&media={{$imageShare}}&description={{$titlePage}}" target="_blank" class="pinterest" title="Share Pinterest">
            <i class="fa-brands fa-pinterest"></i>
        </a>
    @endif
</div>