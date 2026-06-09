<tr>
    <td class="footer-bg">
        <div class="social-icons" style="margin: 20px 0;">
            <a href="https://facebook.com/seuracha" target="_blank"
                style="text-decoration: none; border: none; margin: 0 12px;">
                <img src="{{ asset('img/email/facebook.png') }}" alt="Facebook"
                    style="width: 32px; height: 32px; min-width: 32px; min-height: 32px; max-width: 32px; max-height: 32px; display: inline-block; border: none; object-fit: contain;">
            </a>
            <a href="https://instagram.com/seuracha" target="_blank"
                style="text-decoration: none; border: none; margin: 0 12px;">
                <img src="{{ asset('img/email/instagram.png') }}" alt="Instagram"
                    style="width: 32px; height: 32px; min-width: 32px; min-height: 32px; max-width: 32px; max-height: 32px; display: inline-block; border: none; object-fit: contain;">
            </a>
            <a href="https://wa.me/5585921674573" target="_blank"
                style="text-decoration: none; border: none; margin: 0 12px;">
                <img src="{{ asset('img/email/whatsapp.png') }}" alt="WhatsApp"
                    style="width: 32px; height: 32px; min-width: 32px; min-height: 32px; max-width: 32px; max-height: 32px; display: inline-block; border: none; object-fit: contain;">
            </a>
        </div>
        <div class="links-footer" style="margin-top: 20px; border-top: 1px solid #27272a; padding-top: 15px;">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </div>
    </td>
</tr>