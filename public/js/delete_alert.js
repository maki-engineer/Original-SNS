"use strict";

function delete_alert(e){
  if(!window.confirm('本当に削除しますか？')){
    return false;
  }
  document.deleteform.submit();
}
