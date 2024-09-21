<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        :root {
            --color-primary: #4a90e2;
            --color-primary-dark: #0E46A3;
            --color-secondary: #252c6a;
            --color-error: #cc3333; 
            --color-success: #4bb544;
            --border-radius: 6px;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("download.jpg") no-repeat center center fixed;
            background-size: cover;
            animation: fadeIn 1s ease;
            color: #fff;
        }

        .container {
            width: 400px;
            max-width: 100%;
            margin: 1rem;
            padding: 2rem;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.8);
            border-radius: var(--border-radius);
            animation: fadeIn 1s ease;
            text-align: center;
        }

        .container, .form--input, .form__button {
            font: 500 1rem 'Quicksand', sans-serif;
            -webkit-font: 500 1rem 'Quicksand', sans-serif;
        }

        .form__title {
            margin-bottom: 1rem;
            text-align: center;
            color: var(--color-primary);
        }

        .form__input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form__input:focus {
            border-color: var(--color-primary);
            background: #f9f9f9;
        }

        .form__button {
            width: 100%;
            padding: 1rem 2rem;
            font-weight: bold;
            font-size: 1.1rem;
            color: #fff;
            border: none;
            border-radius: var(--border-radius);
            outline: none;
            cursor: pointer;
            background: var(--color-primary);
            transition: background 0.3s ease;
        }

        .form__button:hover {
            background: var(--color-primary-dark);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management System</h1>
        <h2 class="form__title">Sign Up</h2>
        <form action="home.php" method="post" class="form">
            <div class="form__input-group">
                <input type="email" name="aki.esca19@gmail.com" placeholder="Email" class="form__input" required>
            </div>
            <div class="form__input-group">
                <input type="password" name="admin123" placeholder="Password" class="form__input" required>
            </div>
            <div class="form__input-group">
                <input type="submit" value="Sign Up" class="form__button">
            </div>
        </form>
    </div>
</body>
</html>
