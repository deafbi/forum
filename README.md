<h1 align="center" style="display: block; font-size: 2.5em; font-weight: bold; margin-block-start: 1em; margin-block-end: 1em;">
<a name="logo" href="#"><img align="center" src="https://i.imgur.com/XRN6vcn.png" alt="logo" style="width:25%;height:25%"/></a>
  <br /><br /><strong>Forum</strong>
</h1>

    This is how far I got, before the guy blocked me and did not pay. 
    There might be glitches and bugs. Functions that don't work.
    Please don't make issues or contact me about it. 

This forum is an upgrade from the experimental forum I made a few months ago. This forum was made as a request, but the person who wanted the forum made decided to block me. It's been locked away in my folder for some time now, but I don't feel like running a forum. So here is the open source version of it. - Oh yes, the person wanted it made such that it resembles ogusers, it kinda does but I changed it around a little.

Might work on it from time to time, to fix minor bugs and glitches. 

Best regards,

## Features :sparkles:

Forum comes with an list of features:

- **Discussions**: Create, join, and manage discussions on a variety of topics.
- **User Profiles**: Customize your profile, gain reputation points and badges.
- **Moderation Tools**: Efficient tools to moderate and maintain the community standards.
- **Search**: Quickly find relevant discussions and comments.
- **Imgur only avatars**: Use avatars only from imgur. Security reasons.
- **IP-logging**: Logging IP addresses.
- **Username history**: Change and see old usernames.
- **Rep / Vouch history**: View all given reps and vouches.
- **Previous used avatars**: See and change to previous used avatars
- **Groups**: Join a group or whatever.
- **Roles**: Roles for users.
- **Upgradeable roles**: Upgradeable users
- **And a lot more features**

## Installation :wrench:

Follow these steps to install Forum X on your local machine:

1. Clone this repository using `git clone https://github.com/Decode84/Forum-OGUsers`
2. Navigate to the project folder with `cd Forum-OGUsers`
3. Copy the `.env.example` file to create your own `.env` file: `cp .env.example .env`
4. Configure your `.env` file according to your local environment
5. Run `composer install` to install project dependencies
6. Generate an application key using `php artisan key:generate`
7. Run `php artisan migrate --seed` to set up the database
8. Finally, start the server with `php artisan serve`

Your Forum instance should now be live at `http://localhost:8000`.

## Usage :rocket:

Simply visit `http://localhost:8000` on your browser. Register a new account and check out the forum! or login with `admin:admin`.

## Screenshots of the forum

![Index](https://i.imgur.com/UVqdHZc.png)
![Profile](https://i.imgur.com/TzSAGdK.png)
![Settings](https://i.imgur.com/HkNmwsI.png)
![Forum](https://i.imgur.com/qsK8OET.png)
