<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{

    /**
     * @param mixed $userAgent
     * @return UserSession
     */
    public function setUserAgent($userAgent)
    {
        $this->user_agent = $userAgent;
        return $this;
    }

    /**
     * @param mixed $browserFamily
     * @return UserSession
     */
    public function setBrowserFamily($browserFamily)
    {
        $this->browser_family = $browserFamily;
        return $this;
    }

    /**
     * @param mixed $ip
     * @return UserSession
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }
}
