<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    test react
    <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
    <div id="like_button_container"></div>
    <!-- Load our React component. -->
    <script>
        'use strict';

        const e = React.createElement;

        class LikeButton extends React.Component {
            constructor(props) {
                super(props);
                this.state = {
                    liked: false
                };
            }

            render() {
                if (this.state.liked) {
                    return 'You liked this.';
                }

                return e(
                    'button', {
                        onClick: () => this.setState({
                            liked: true
                        })
                    },
                    'Like'
                );
            }
        }

        const domContainer = document.querySelector('#like_button_container');
        ReactDOM.render(e(LikeButton), domContainer);
    </script>

</body>

</html>