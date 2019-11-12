<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifikasiPengiriman extends Notification
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
        $this->data = $data;
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
        $url = url('/orders');
        $mail = new MailMessage;
        $mail->from($this->data->email, $this->data->nama)
            ->subject('Detail Pengiriman Order ID:'.$this->data->orders_id)
            ->line('Berikut adalah detail pengiriman untuk Order ID: '.$this->data->orders_id);
        if($this->data->kode!=null||$this->data->kode!=""){
            $mail->line('Kode Pengiriman/Surat Jalan : '.$this->data->kode);
        }
        $mail->line('Jasa Pengiriman : '.$this->data->pengirim);
        $mail->line('Estimasi Pengiriman :'.$this->data->eta.' hari kerja');
        $mail->line('Biaya Pengiriman : '.$this->data->biaya);
        if($this->data->kode==null||$this->data->kode==""){
        $mail->action('Halaman Order', $url)
            ->line('Barang baru akan dikirim setelah anda melakukan pelunasan pembayaran!')
            ->line('Atas perhatiannya kami ucapkan terima kasih');
        }else{
        $mail->action('Halaman Order', $url)
            ->line('Barang yang anda pesan telah kami kirim')
            ->line('Atas perhatiannya kami ucapkan terima kasih');
        }
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
