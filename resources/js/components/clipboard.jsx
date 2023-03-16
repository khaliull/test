import React from 'react'
import { useClipboard } from 'use-clipboard-copy';
import axios from 'axios';

export default function Clipboard(props) {
  const [copy, setCopy] = React.useState(false);

  const clipboard = useClipboard({
      onSuccess() {
       setCopy(true)
     },
  });

  const copied = async () => {
    try {

        let response = await axios.post('/test/' + props.testKey + '/paired-test/' + props.keyPairedTest)

      } catch(error) {

        alert('Произошла ошибка, попробуйте еще раз')

        return
      }

      clipboard.copy(props.keyPairedTest)
  }
  return (
    <div>
      <button className="btn btn-sm btn-outline-primary text-link-white" onClick={() => copied()}>
      Ссылка для приглашения
      </button><br />
      {copy ? <small className="text-white">Скопировано</small> : null}
    </div>
  );
}
