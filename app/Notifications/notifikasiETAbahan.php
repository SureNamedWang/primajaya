<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class notifikasiETAbahan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($eta,$admins)
    {
        //
        $this->eta=$eta;
        $this->admins=$admins;
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
        $url = url('/produksi/'.$this->eta->get('id'));
        $mail = new MailMessage;
        //dd($this->admins);
        $admin=array();
        foreach($this->admins as $emin){
            array_push($admin,$emin->email);
        }
        //dd($admin);
        $mail->from($this->eta->get('email'), $this->eta->get('nama'))
            ->cc($admin)
            ->subject('ETA Bahan Order ID:'.$this->eta->get('id'))
            ->greeting('Perihal notifikasi kekurangan bahan!')
            ->line('Bahan untuk Order ID: '.$this->eta->get('id').' sudah dipesan dan akan tiba pada:')
            ->line('Tanggal : '.$this->eta->get('tanggal')->day.' '.$this->eta->get('tanggal')->locale('id')->monthName.' '.$this->eta->get('tanggal')->year)
            ->line('Hari : '.$this->eta->get('tanggal')->locale('id')->dayName)
            ->line('Jam : '.$this->eta->get('tanggal')->hour.':'.$this->eta->get('tanggal')->minute)
            ->action('Lihat Produksi', $url)
            ->line('Terima kasih atas perhatiannya');
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
