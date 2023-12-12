<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Random avatar image from array of images
        $avatars = [
            'https://64.media.tumblr.com/b50b5e7bcfbb263f8aa0a919881ce690/3fd550c1fdb865f6-45/s250x400/555815b6c31d4ce7b279a31ea0594bc2cbb7adb7.png',
            'https://64.media.tumblr.com/889b4ad444eea7833e7093c82e43d6e1/ed422bd94c715c3e-84/s250x400/43244d3990f31a311102946e5125e88a138a0373.png',
            'https://64.media.tumblr.com/ed2ab2416407afc0d3fbb262bbb3f60b/1b0bdac815cbd792-48/s250x400/621b6be33a6f52d663517b229fdc49ed0166d2f5.png',
            'https://64.media.tumblr.com/687aa43463053bf11b6cc833cdf803ec/5a1ea9dcf4049c97-6b/s250x400/648aa1fc0f20135c9e310e7fe92d23a13dfff276.png',
            'https://64.media.tumblr.com/9cf0e022d6bf8552e18fbec734ffe101/41c573aee5fd1580-01/s250x400/357c789f704d422ad49ac6841f6e9ad0645cb5e9.png',
            'https://64.media.tumblr.com/6873d2d621b739852591c70474cea106/6887d3b576a41423-d3/s250x400/278edf735b6b3c0bef0e62394d2b07b09a5ec748.png',
            'https://64.media.tumblr.com/919d68b81c3417d6c0939c45ff022cc3/b7fc9e4d3e4ee126-39/s250x400/d79eccc91a82fbd8997b21a58a4a7c519f454110.png',
            'https://64.media.tumblr.com/7362329ae6e07519cf28ec47b971fd6b/1724faad36a621dd-6f/s250x400/4524b45807a79623883424dab2c1fe963c117aab.png',
            'https://64.media.tumblr.com/92f4e4539c3f2361d7016ca528bd9cb3/09a9151f9c6cee4e-9c/s250x400/697374d89dfdc9cf6870ebac67c2234afba5a5e0.png',
            'https://64.media.tumblr.com/71ab6f05bdaf4aeae8245b681ec10c72/46af1659806c93d6-07/s250x400/d53aa23052df87cdcf0f90f6ced42e6e7832bd13.png',
            'https://64.media.tumblr.com/850ea0c65dc22c0669239675a0f73f83/65faefdce5445717-3e/s250x400/6044a824bfc5d47e535fef0dd158a678d732ff76.png',
            'https://64.media.tumblr.com/93530ba1e70c4e455608b96bb3981252/f3a8fbd4430d9795-03/s250x400/8e9ba314063d28b89cf8963a5ac5f33d9dfbcdd5.png',
            'https://64.media.tumblr.com/fed2a8dd7571a5d7783f806c2062b79d/tumblr_r1h2wc2Zzo1rpwm80o1_250.png',
            'https://64.media.tumblr.com/3541a3c658fd68ac14730bb913affb23/407c6010fd3c714e-0b/s250x400/d26b0268650d8f4f33881c660ce28a7b1a0acc5c.png',
            'https://64.media.tumblr.com/29359ffc0b3f748aa341cbc5445675d0/7cd847fb66bb4dde-07/s250x400/0c9afbf6a3bc0f375cf59ee161f10a899ec229cb.jpg',
            'https://64.media.tumblr.com/0a738f8413b2b348c85ec6e2e8eaac20/faa770065e603553-bc/s250x400/df6110d28257dd0e49f10f7fe78e337c8a8a0b7c.png',
            'https://64.media.tumblr.com/de4ea6549046d9ec323a00bebbd77e65/cb3ae0e75eb7e0d5-df/s250x400/a5652e8f36424c0a6f9dc90af8073403a2bcc672.png',
            'https://64.media.tumblr.com/20b998206fe2bdf4ce50342c09cadf85/591c4b2e8b213c6a-5d/s250x400/a7d5ff2fb6b02d187144a5942eef37e2b1cf18db.png',
            'https://64.media.tumblr.com/b28c7608f5852cde9a4cc9d9ce36f268/786ed376049fb390-15/s250x400/420479791384330ecaf2e3ade09d4df41f79bad4.png',
            'https://64.media.tumblr.com/d40acfc70fbfd09f9940478bc63ed3ce/66e457ea51329744-9e/s250x400/aa200f637e3176db43724004353220210d21b272.png',
        ];

        return [
            'username' => $this->faker->unique()->userName,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => $avatars[array_rand($avatars)],
            'last_login_at' => now(),
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
