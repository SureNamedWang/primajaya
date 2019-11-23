<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifikasiPenerimaan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data=$data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/storage/'.$this->data->bukti_penerimaan);
        $mail = new MailMessage;
        $mail->from($this->data->email, $this->data->nama)
            ->subject('Notifikasi Penerimaan Order ID:'.$this->data->orders_id)
            ->line('Sehubungan dengan pengiriman barang untuk Order ID: '.$this->data->orders_id);
        if($this->data->kode!=null||$this->data->kode!=""){
            $mail->line('Dengan Kode Pengiriman/Surat Jalan : '.$this->data->kode);
        }
        $mail->action('Bukti Penerimaan', $url)
        ->line('Barang telah berhasil dikirim dan tiba ditempat.')
        ->line('Terima Kasih atas kesetiaan anda memesan tenda pada CV.Prima Jaya.')
        ->line('Kami tunggu pesanan anda selanjutnya!');
        //dd($mail);
        return ($mail);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
